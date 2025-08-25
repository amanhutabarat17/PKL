# app.py
import io
import re
from datetime import datetime

import pandas as pd
import streamlit as st
import plotly.express as px

# ========================= CONFIG =========================
st.set_page_config(page_title="KPI Dashboard", layout="wide")
st.title("📊 KPI Dashboard – Mingguan ➜ Bulanan ➜ Tahunan (Auto Detect)")

# ========================= CONSTANTS ======================
ID_MONTHS = [
    "januari", "februari", "maret", "april", "mei", "juni",
    "juli", "agustus", "september", "oktober", "november", "desember"
]
MONTH_ORDER = {m: i for i, m in enumerate(ID_MONTHS, start=1)}
WEEK_LABELS = ["minggu 1", "minggu 2", "minggu 3", "minggu 4", "target"]
CATS = ["SKA", "NON SKA", "NA"]

EN_TO_ID_MONTH = {
    "january": "januari", "february": "februari", "march": "maret",
    "april": "april", "may": "mei", "june": "juni", "july": "juli",
    "august": "agustus", "september": "september", "october": "oktober",
    "november": "november", "december": "desember"
}


# ========================= HELPERS ========================
def norm(s):
    if pd.isna(s):
        return ""
    s = str(s).replace("\u00A0", " ").strip().lower()
    s = re.sub(r"\s+", " ", s)
    return s


def month_of_token(token):
    t = norm(token)
    # dukung Indonesia & English
    if t in ID_MONTHS:
        return t
    if t in EN_TO_ID_MONTH:
        return EN_TO_ID_MONTH[t]
    return None


def week_from_token(token):
    t = norm(token)
    if "target" in t:
        return "target"
    m = re.search(r"minggu\s*(ke\s*)?(\d)", t)
    if m:
        return f"minggu {m.group(2)}"
    return None


def try_read_excel(file) -> pd.DataFrame:
    # Baca dengan header 2 baris (sesuai file kamu), fallback ke header tunggal
    for hdr in ([0, 1], [0], None):
        try:
            if hdr is None:
                return pd.read_excel(file, engine="openpyxl")
            return pd.read_excel(file, engine="openpyxl", header=hdr)
        except Exception:
            try:
                if hdr is None:
                    return pd.read_excel(file)
                return pd.read_excel(file, header=hdr)
            except Exception:
                continue
    raise ValueError("Tidak dapat membaca file Excel.")


def build_long_and_target_from_multidx(df_raw: pd.DataFrame):
    """
    VERSI DIPERBAIKI: SKIP baris dengan nilai 0 atau kosong + validasi kategori ketat + anti duplikasi
    Format Excel:
      - Header 2 baris (MultiIndex)
      - Kolom awal: Nama, Kategori (sering merge → di-ffill)
      - Per bulan ada Minggu 1..4 + 1 kolom TARGET
    """
    if not isinstance(df_raw.columns, pd.MultiIndex):
        raise ValueError("File tidak memiliki header 2 baris. Pastikan format sesuai Excel kamu.")

    # deteksi kolom nama & kategori
    nama_col = None
    kat_col = None
    for col in df_raw.columns:
        a, b = col
        if nama_col is None and ("nama" in norm(a) or "nama" in norm(b)):
            nama_col = col
        if kat_col is None and ("kategori" in norm(a) or "kategori" in norm(b)):
            kat_col = col

    # fallback aman ke 2 kolom pertama
    if nama_col is None:
        nama_col = df_raw.columns[0]
    if kat_col is None:
        kat_col = df_raw.columns[1]

    df = df_raw.copy()
    
    # ffill nama & kategori (karena merge cell di Excel)
    df[nama_col] = df[nama_col].ffill()
    df[kat_col] = df[kat_col].ffill()

    # TAMBAHAN: Bersihkan baris yang nama kosong atau invalid
    df = df[df[nama_col].notna()]
    df = df[df[nama_col].astype(str).str.strip() != ""]
    df = df[df[nama_col].astype(str).str.lower() != "nan"]

    long_rows = []
    target_rows = []
    last_month = None
    processed_columns = set()  # Track kolom yang sudah diproses
    
    # Set untuk mencegah duplikasi data
    seen_long_data = set()
    seen_target_data = set()

    # iterate kolom sesuai urutan tampil di Excel
    for col in df.columns:
        if col in [nama_col, kat_col]:
            continue
            
        a, b = col  # level-0, level-1
        m = month_of_token(a)
        w = week_from_token(b)

        if m:
            last_month = m
            # nilai mingguan
            if w and w != "target":
                col_key = f"{m}_{w}"
                if col_key in processed_columns:
                    continue
                processed_columns.add(col_key)
                
                vals = df[col].tolist()
                for idx, v in enumerate(vals):
                    if idx >= len(df):
                        break
                        
                    nm = str(df[nama_col].iloc[idx]).strip()
                    kt_raw = str(df[kat_col].iloc[idx]).strip()
                    
                    # Skip jika nama kosong
                    if nm == "" or nm == "nan" or pd.isna(nm):
                        continue

                    # Validasi dan normalisasi kategori
                    kt = kt_raw.upper().strip()
                    # Hanya terima kategori yang benar-benar valid
                    if kt not in ["SKA", "NON SKA"]:
                        # Coba deteksi pattern
                        if "ska" in kt_raw.lower() and "non" not in kt_raw.lower():
                            kt = "SKA"
                        elif "non" in kt_raw.lower() and "ska" in kt_raw.lower():
                            kt = "NON SKA"
                        else:
                            # Set ke NA hanya jika benar-benar tidak jelas
                            kt = "NA"

                    # Validasi nilai - hanya tambahkan jika > 0
                    try:
                        val = float(v) if pd.notna(v) and str(v).strip() != "" else 0.0
                    except:
                        val = 0.0

                    # *** HANYA TAMBAHKAN JIKA NILAI > 0 DAN BELUM PERNAH ADA ***
                    if val > 0:
                        # Buat unique key untuk deteksi duplikasi
                        unique_key = (nm, kt, m, w, val)
                        if unique_key not in seen_long_data:
                            seen_long_data.add(unique_key)
                            long_rows.append([nm, kt, m, w, val, None])
                        
        elif last_month is not None:
            # kolom 'TARGET' muncul setelah blok bulan → gunakan last_month
            if "target" in norm(a) or "target" in norm(b):
                target_key = f"{last_month}_target"
                if target_key in processed_columns:
                    continue
                processed_columns.add(target_key)
                
                vals = df[col].tolist()
                for idx, v in enumerate(vals):
                    if idx >= len(df):
                        break
                        
                    nm = str(df[nama_col].iloc[idx]).strip()
                    kt_raw = str(df[kat_col].iloc[idx]).strip()
                    
                    if nm == "" or nm == "nan" or pd.isna(nm):
                        continue

                    # Sama dengan validasi kategori di atas
                    kt = kt_raw.upper().strip()
                    if kt not in ["SKA", "NON SKA"]:
                        if "ska" in kt_raw.lower() and "non" not in kt_raw.lower():
                            kt = "SKA"
                        elif "non" in kt_raw.lower() and "ska" in kt_raw.lower():
                            kt = "NON SKA"
                        else:
                            kt = "NA"

                    try:
                        val = float(v) if pd.notna(v) and str(v).strip() != "" else 0.0
                    except:
                        val = 0.0

                    # *** HANYA TAMBAHKAN TARGET JIKA > 0 DAN BELUM PERNAH ADA ***
                    if val > 0:
                        # Buat unique key untuk deteksi duplikasi target
                        unique_key = (nm, kt, last_month, val)
                        if unique_key not in seen_target_data:
                            seen_target_data.add(unique_key)
                            target_rows.append([nm, kt, last_month, val, None])

    long_df = pd.DataFrame(long_rows, columns=["Nama", "Kategori", "bulan", "minggu", "nilai", "Tahun"])
    target_df = pd.DataFrame(target_rows, columns=["Nama", "Kategori", "bulan", "target", "Tahun"])

    # TAMBAHAN: Double-check untuk menghapus duplikasi jika masih ada
    long_df = long_df.drop_duplicates(subset=["Nama", "Kategori", "bulan", "minggu", "nilai"], keep="first")
    target_df = target_df.drop_duplicates(subset=["Nama", "Kategori", "bulan", "target"], keep="first")

    # Pastikan kategori sesuai standar
    long_df["bulan"] = pd.Categorical(long_df["bulan"], categories=ID_MONTHS, ordered=True)
    target_df["bulan"] = pd.Categorical(target_df["bulan"], categories=ID_MONTHS, ordered=True)

    return long_df, target_df


def month_total_by_category_complete(df_filtered):
    """Sudah tidak perlu filter lagi karena data parsing sudah bersih"""
    g = df_filtered.groupby(["bulan", "Kategori"], as_index=False)["nilai"].sum()
    pivot = (g.pivot(index="bulan", columns="Kategori", values="nilai")
             .reindex(ID_MONTHS)
             .reindex(columns=CATS, fill_value=0)
             .fillna(0))
    out = pivot.reset_index().melt(id_vars="bulan", var_name="Kategori", value_name="nilai")
    out["Kategori"] = out["Kategori"].astype(str)
    return out


def person_total(df_filtered, month_selected, period="Bulanan"):
    """Sudah tidak perlu filter lagi karena data parsing sudah bersih"""
    if period == "Tahunan":
        d = (df_filtered.groupby(["Nama", "Kategori"], as_index=False)["nilai"].sum())
    else:
        d = (df_filtered[df_filtered["bulan"] == month_selected]
             .groupby(["Nama", "Kategori"], as_index=False)["nilai"].sum())
    return d.sort_values(["Kategori", "Nama"])


def weekly_sum_by_category_complete(df_filtered, month_selected=None, period="Bulanan"):
    """Sudah tidak perlu filter lagi karena data parsing sudah bersih"""
    if period == "Tahunan":
        d = df_filtered[df_filtered["minggu"].isin(["minggu 1", "minggu 2", "minggu 3", "minggu 4"])]
    else:
        d = df_filtered[(df_filtered["bulan"] == month_selected) &
                        (df_filtered["minggu"].isin(["minggu 1", "minggu 2", "minggu 3", "minggu 4"]))]

    g = d.groupby(["Kategori", "minggu"], as_index=False)["nilai"].sum()
    weeks = ["minggu 1", "minggu 2", "minggu 3", "minggu 4"]
    idx = pd.MultiIndex.from_product([CATS, weeks], names=["Kategori", "minggu"])
    pivot = g.set_index(["Kategori", "minggu"]).reindex(idx, fill_value=0).reset_index()

    # urutkan minggu 1..4
    def wkey(x):
        m = re.search(r"(\d+)", norm(x))
        return int(m.group(1)) if m else 99

    pivot["__k"] = pivot["minggu"].apply(wkey)
    pivot = pivot.sort_values(["Kategori", "__k"]).drop(columns="__k")
    return pivot


def eval_target(long_df, target_df):
    """Hitung total minggu 1..4 vs target per (Nama, Kategori, bulan, Tahun)."""
    weekly = long_df[long_df["minggu"].isin(["minggu 1", "minggu 2", "minggu 3", "minggu 4"])]
    actual = (weekly.groupby(["Nama", "Kategori", "bulan", "Tahun"], as_index=False)["nilai"].sum())
    merged = pd.merge(actual, target_df, on=["Nama", "Kategori", "bulan", "Tahun"], how="left")
    merged["target"] = merged["target"].fillna(0)
    merged["Status"] = merged.apply(lambda r: "Tercapai" if r["nilai"] >= r["target"] else "Tidak Tercapai", axis=1)
    merged = merged.sort_values(["bulan", "Kategori", "Nama"]).reset_index(drop=True)
    return merged


def yearly_percentage_by_name(long_df, target_df):
    """
    Persentase capai target per NAMA untuk 1 tahun:
      pct = (sum nilai minggu1-4) / (sum target) * 100
    """
    weekly = long_df[long_df["minggu"].isin(["minggu 1", "minggu 2", "minggu 3", "minggu 4"])]
    actual = weekly.groupby(["Nama", "Kategori", "Tahun"], as_index=False)["nilai"].sum()
    target = target_df.groupby(["Nama", "Kategori", "Tahun"], as_index=False)["target"].sum()

    merged = pd.merge(actual, target, on=["Nama", "Kategori", "Tahun"], how="outer").fillna(0)
    by_name = merged.groupby(["Nama", "Tahun"], as_index=False).agg({"nilai": "sum", "target": "sum"})
    by_name["Persentase"] = by_name.apply(lambda r: (r["nilai"] / r["target"] * 100) if r["target"] > 0 else 0, axis=1)
    return by_name


def to_excel_bytes(df_raw, long_df, month_sum, week_sum, person_sum, year_sum, target_df, eval_df, yearly_pct_df):
    output = io.BytesIO()
    with pd.ExcelWriter(output, engine="xlsxwriter") as writer:
        # Data
        if isinstance(df_raw.columns, pd.MultiIndex):
            df_raw.to_excel(writer, index=False, sheet_name="Raw")
        else:
            df_raw.copy().to_excel(writer, index=False, sheet_name="Raw")

        long_df.to_excel(writer, index=False, sheet_name="Long")
        target_df.to_excel(writer, index=False, sheet_name="Target_Long")
        eval_df.to_excel(writer, index=False, sheet_name="Eval_Target")
        yearly_pct_df.to_excel(writer, index=False, sheet_name="Yearly_Percentage")

        month_sum.to_excel(writer, index=False, sheet_name="Monthly_Long")
        week_sum.to_excel(writer, index=False, sheet_name="Weekly_Long")
        person_sum.to_excel(writer, index=False, sheet_name="Person_Long")
        year_sum.to_excel(writer, index=False, sheet_name="Yearly_Total")

        # Pivot utk chart Excel
        month_pivot = (month_sum.pivot(index="bulan", columns="Kategori", values="nilai")
                       .reindex(ID_MONTHS).reindex(columns=CATS, fill_value=0)
                       .fillna(0).reset_index())
        week_pivot = (week_sum.pivot(index="minggu", columns="Kategori", values="nilai")
                      .reindex(columns=CATS, fill_value=0).fillna(0).reset_index())
        person_pivot = (person_sum.pivot(index="Nama", columns="Kategori", values="nilai")
                        .reindex(columns=CATS, fill_value=0).fillna(0).reset_index())

        month_pivot.to_excel(writer, index=False, sheet_name="Monthly")
        week_pivot.to_excel(writer, index=False, sheet_name="Weekly")
        person_pivot.to_excel(writer, index=False, sheet_name="PersonMonth")

        wb = writer.book
        # Chart Monthly (stacked)
        ws_m = writer.sheets["Monthly"]
        n_rows = len(month_pivot)
        chart_m = wb.add_chart({"type": "column", "subtype": "stacked"})
        for i, _cat in enumerate(CATS, start=1):
            chart_m.add_series({
                "name": ["Monthly", 0, i],
                "categories": ["Monthly", 1, 0, n_rows, 0],
                "values": ["Monthly", 1, i, n_rows, i],
            })
        chart_m.set_title({"name": "Total per Bulan (Stacked by Kategori)"})
        ws_m.insert_chart("G2", chart_m)

        # Chart Weekly (grouped)
        ws_w = writer.sheets["Weekly"]
        n_rows_w = len(week_pivot)
        chart_w = wb.add_chart({"type": "column"})
        for i, _cat in enumerate(CATS, start=1):
            chart_w.add_series({
                "name": ["Weekly", 0, i],
                "categories": ["Weekly", 1, 0, n_rows_w, 0],
                "values": ["Weekly", 1, i, n_rows_w, i],
            })
        chart_w.set_title({"name": "Nilai per Minggu (per Kategori)"})
        ws_w.insert_chart("G2", chart_w)

        # Chart Person (stacked)
        ws_p = writer.sheets["PersonMonth"]
        n_rows_p = len(person_pivot)
        chart_p = wb.add_chart({"type": "column", "subtype": "stacked"})
        for i, _cat in enumerate(CATS, start=1):
            chart_p.add_series({
                "name": ["PersonMonth", 0, i],
                "categories": ["PersonMonth", 1, 0, n_rows_p, 0],
                "values": ["PersonMonth", 1, i, n_rows_p, i],
            })
        chart_p.set_title({"name": "Total per Orang"})
        ws_p.insert_chart("G2", chart_p)

        # Chart Yearly Total
        ws_y = writer.sheets["Yearly_Total"]
        n_rows_y = len(year_sum)
        chart_y = wb.add_chart({"type": "column"})
        chart_y.add_series({
            "name": "Total Tahunan",
            "categories": ["Yearly_Total", 1, 0, n_rows_y, 0],
            "values": ["Yearly_Total", 1, 1, n_rows_y, 1],
            "data_labels": {"value": True},
        })
        chart_y.set_title({"name": "Total KPI per Tahun"})
        ws_y.insert_chart("E2", chart_y)

        # Chart Yearly Percentage
        ws_yp = writer.sheets["Yearly_Percentage"]
        if not yearly_pct_df.empty:
            names = yearly_pct_df["Nama"].tolist()
            vals = yearly_pct_df["Persentase"].tolist()
            chart_pct = wb.add_chart({"type": "column"})
            chart_pct.add_series({
                "name": "Persentase Capaian (%)",
                "categories": ["Yearly_Percentage", 1, 0, len(names), 0],
                "values": ["Yearly_Percentage", 1, 3, len(vals), 3],
                "data_labels": {"value": True},
            })
            chart_pct.set_title({"name": "Persentase Capaian Tahunan per Nama"})
            ws_yp.insert_chart("F2", chart_pct)

    return output.getvalue()


def debug_data_info(df_raw, long_df, target_df, df_year):
    """Fungsi untuk debugging informasi data"""
    st.write("### 🔍 Debug Info")
    col1, col2, col3, col4 = st.columns(4)

    with col1:
        st.write("**Data Raw:**")
        st.write(f"Shape: {df_raw.shape}")
        if isinstance(df_raw.columns, pd.MultiIndex):
            st.write("✅ MultiIndex columns detected")
        else:
            st.write("❌ Single level columns")

    with col2:
        st.write("**Data Parsed:**")
        st.write(f"Long DF: {long_df.shape[0]:,} rows")
        st.write(f"Target DF: {target_df.shape[0]:,} rows")
        st.write(f"Year filtered: {df_year.shape[0]:,} rows")

    with col3:
        st.write("**Nilai Statistics:**")
        total_nilai = df_year["nilai"].sum()
        min_nilai = df_year["nilai"].min() if len(df_year) > 0 else 0
        max_nilai = df_year["nilai"].max() if len(df_year) > 0 else 0
        st.write(f"Total: {total_nilai:,.2f}")
        st.write(f"Range: {min_nilai:.2f} - {max_nilai:.2f}")

    with col4:
        st.write("**Kategori Distribution:**")
        if not df_year.empty:
            cat_counts = df_year["Kategori"].value_counts()
            for cat, count in cat_counts.items():
                total_cat = df_year[df_year["Kategori"] == cat]["nilai"].sum()
                st.write(f"{cat}: {count} rows (Σ={total_cat:.0f})")

    # Detail breakdown per bulan dan kategori
    if st.checkbox("Show detailed breakdown"):
        st.write("**Monthly breakdown by category:**")
        monthly_detail = df_year.groupby(["bulan", "Kategori"])["nilai"].agg(["count", "sum"]).reset_index()
        st.dataframe(monthly_detail)

    # Cek duplikasi dengan informasi lebih detail
    duplicates = long_df.duplicated(subset=['Nama', 'Kategori', 'bulan', 'minggu', 'Tahun'])
    if duplicates.sum() > 0:
        st.warning(f"⚠️ Found {duplicates.sum()} duplicate rows!")
        # Tampilkan baris duplikat
        dup_rows = long_df[duplicates]
        st.write("**Duplicate rows found:**")
        st.dataframe(dup_rows[['Nama', 'Kategori', 'bulan', 'minggu', 'nilai']])
        
        # Tampilkan summary duplikasi per bulan/kategori
        dup_summary = dup_rows.groupby(['bulan', 'Kategori']).agg({
            'nilai': ['count', 'sum'],
            'Nama': 'nunique'
        }).round(0)
        st.write("**Duplication summary by month/category:**")
        st.dataframe(dup_summary)
    else:
        st.success("✅ No duplicate rows found")
        
    # Tambahan: Cek apakah ada anomali dalam data
    if not df_year.empty:
        # Deteksi nilai yang sangat tinggi (outliers)
        q95 = df_year["nilai"].quantile(0.95)
        outliers = df_year[df_year["nilai"] > q95 * 3]  # 3x dari percentile ke-95
        if not outliers.empty:
            st.warning(f"⚠️ Found {len(outliers)} potential outliers (nilai > {q95*3:.0f})")
            st.dataframe(outliers[['Nama', 'Kategori', 'bulan', 'minggu', 'nilai']])
            
        # Deteksi jika ada bulan dengan total nilai yang sangat berbeda
        monthly_totals = df_year.groupby('bulan')['nilai'].sum()
        if len(monthly_totals) > 1:
            mean_monthly = monthly_totals.mean()
            std_monthly = monthly_totals.std()
            if std_monthly > 0:
                anomaly_months = monthly_totals[abs(monthly_totals - mean_monthly) > 2 * std_monthly]
                if not anomaly_months.empty:
                    st.warning(f"⚠️ Months with unusual totals:")
                    for month, total in anomaly_months.items():
                        st.write(f"- {month}: {total:.0f} (avg: {mean_monthly:.0f})")



# ========================= SIDEBAR =========================
st.sidebar.header("Kontrol")
uploaded = st.sidebar.file_uploader("Upload file Excel (.xlsx / .xls)", type=["xlsx", "xls"])
manual_year = st.sidebar.number_input(
    "Tahun (jika file tidak punya kolom Tahun)", min_value=2000, max_value=2100,
    value=datetime.now().year, step=1
)
period_selected = st.sidebar.radio("Periode", options=["Bulanan", "Tahunan"], index=0)
cats_selected = st.sidebar.multiselect("Filter Kategori", options=CATS, default=CATS)
show_tables = st.sidebar.checkbox("Tampilkan tabel data ringkas", value=True)
show_debug = st.sidebar.checkbox("Tampilkan debug info", value=True)

if not uploaded:
    st.info("Silakan upload file Excel asli (format 2 baris header).")
    st.stop()

# ========================= LOAD & PARSE ====================
try:
    df_raw = try_read_excel(uploaded)
except Exception as e:
    st.error(f"Gagal membaca Excel: {e}")
    st.stop()

try:
    long_df, target_df = build_long_and_target_from_multidx(df_raw)
except Exception as e:
    st.error(f"Format tidak dikenali: {e}")
    st.stop()

# Isi Tahun jika kosong
if "Tahun" not in long_df.columns or long_df["Tahun"].isna().all():
    long_df["Tahun"] = int(manual_year)
if "Tahun" not in target_df.columns or target_df["Tahun"].isna().all():
    target_df["Tahun"] = int(manual_year)
long_df["Tahun"] = long_df["Tahun"].astype(int)
target_df["Tahun"] = target_df["Tahun"].astype(int)

# Filter kategori
if cats_selected:
    long_df = long_df[long_df["Kategori"].isin(cats_selected)]
    target_df = target_df[target_df["Kategori"].isin(cats_selected)].copy()

# Filter Tahun
st.sidebar.markdown("---")
all_years = sorted(long_df["Tahun"].unique().tolist())
year_selected = st.sidebar.selectbox("Pilih Tahun", options=all_years, index=max(0, len(all_years) - 1))
df_year = long_df[long_df["Tahun"] == year_selected].copy()
df_year_target = target_df[target_df["Tahun"] == year_selected].copy()

# Dropdown bulan
months_in_year = ID_MONTHS
month_selected = st.sidebar.selectbox(
    "Pilih Bulan (untuk grafik Per Orang & Mingguan)", options=months_in_year, index=0
)

# Filter Nama
all_names = sorted(df_year["Nama"].dropna().unique().tolist())
names_selected = st.sidebar.multiselect("Filter Nama (kosong = semua)", options=all_names, default=all_names)
if names_selected and len(names_selected) > 0:
    df_year = df_year[df_year["Nama"].isin(names_selected)]
    df_year_target = df_year_target[df_year_target["Nama"].isin(names_selected)].copy()

# Debug info (opsional)
if show_debug:
    debug_data_info(df_raw, long_df, target_df, df_year)

# ========================= METRICS =========================
c1, c2, c3 = st.columns(3)
with c1:
    # Total hanya dari minggu 1-4 (sudah tidak ada nilai 0 di data)
    total_w14 = df_year[
        df_year["minggu"].isin(["minggu 1", "minggu 2", "minggu 3", "minggu 4"])
    ]["nilai"].sum()
    st.metric("Total KPI (Minggu 1-4)", f"{total_w14:,.0f}")

with c2:
    st.metric("Jumlah Orang (aktif)", f"{df_year['Nama'].nunique():,}")

with c3:
    st.metric("Bulan Terisi", f"{df_year['bulan'].dropna().nunique():,}")

# ========================= CHARTS ==========================
# 1) Total per Bulan Jan–Des • 3 kategori
st.subheader("1) Total per Bulan (Jan–Des) • 3 kategori (SKA / NON SKA / NA)")
month_sum = month_total_by_category_complete(df_year)
fig1 = px.bar(
    month_sum, x="bulan", y="nilai", color="Kategori", barmode="stack",
    category_orders={"bulan": ID_MONTHS, "Kategori": CATS},
    title=f"Total per Bulan (Tahun {year_selected})"
)
st.plotly_chart(fig1, use_container_width=True)

# 2) Grafik Batang • Total per Orang
st.subheader("2) Grafik Batang • Total per Orang")
person_sum = person_total(df_year, month_selected, period=period_selected)
fig2 = px.bar(
    person_sum, x="Nama", y="nilai", color="Kategori",
    category_orders={"Kategori": CATS},
    title=(f"Total per Orang – Bulan {month_selected.capitalize()} (Tahun {year_selected})"
           if period_selected == "Bulanan" else f"Total per Orang – Tahunan (Tahun {year_selected})")
)
fig2.update_xaxes(tickangle=45)
st.plotly_chart(fig2, use_container_width=True)

# 3) Rekap Nilai per Minggu • per Kategori
st.subheader("3) Rekap Nilai per Minggu • per Kategori")
week_sum = weekly_sum_by_category_complete(df_year, month_selected, period=period_selected)
fig3 = px.bar(
    week_sum, x="minggu", y="nilai", color="Kategori", barmode="group",
    category_orders={"Kategori": CATS},
    title=(f"Nilai per Minggu • Bulan {month_selected.capitalize()} (Tahun {year_selected})"
           if period_selected == "Bulanan" else f"Nilai per Minggu • Tahunan (Tahun {year_selected})")
)
st.plotly_chart(fig3, use_container_width=True)

# 4) Persentase Capaian Tahunan
st.subheader("4) Persentase Capaian Tahunan (semua nama)")
yearly_pct_df = yearly_percentage_by_name(df_year, df_year_target)
if not yearly_pct_df.empty:
    fig5 = px.bar(
        yearly_pct_df.sort_values("Persentase", ascending=False),
        x="Nama", y="Persentase",
        title=f"Persentase Capaian Target (%) – Tahun {year_selected}",
        text="Persentase"
    )
    fig5.update_traces(texttemplate="%{text:.1f}%", textposition="outside", cliponaxis=False)
    fig5.update_yaxes(range=[0, max(100, float(yearly_pct_df["Persentase"].max()) * 1.1)])
    fig5.update_xaxes(tickangle=45)
    st.plotly_chart(fig5, use_container_width=True)
else:
    st.info("Tidak ada data persentase untuk ditampilkan.")

# 5) Total KPI per Tahun
st.subheader("5) Total per Tahun (hanya Minggu 1–4)")
year_sum = (
    long_df[long_df["minggu"].isin(["minggu 1", "minggu 2", "minggu 3", "minggu 4"])]
    .groupby("Tahun", as_index=False)["nilai"].sum().sort_values("Tahun")
)
fig4 = px.bar(year_sum, x="Tahun", y="nilai", title="Total KPI per Tahun (Sum Minggu 1–4)")
st.plotly_chart(fig4, use_container_width=True)

# ========================= TABLES (opsional) ================
if show_tables:
    st.markdown("### 🔎 Data Ringkas")
    t1, t2, t3, t4 = st.tabs([
        "Total Bulanan x Kategori",
        "Per Orang (Bulan/Tahun)",
        "Mingguan x Kategori (Bulan/Tahun)",
        "Evaluasi Target (Bulan)"
    ])
    with t1:
        st.dataframe(month_sum, use_container_width=True)
    with t2:
        st.dataframe(person_sum, use_container_width=True)
    with t3:
        st.dataframe(week_sum, use_container_width=True)

# ========================= EVALUASI TARGET ==================
df_eval = eval_target(df_year, df_year_target)
if show_tables:
    with t4:
        st.dataframe(df_eval, use_container_width=True)

# ========================= DOWNLOAD ========================
st.markdown("---")
st.subheader("📥 Unduh Rekap Excel (sheet + chart)")
excel_bytes = to_excel_bytes(
    df_raw, df_year, month_sum, week_sum, person_sum, year_sum,
    df_year_target, df_eval, yearly_pct_df
)
st.download_button(
    label="💾 Download Rekap KPI.xlsx",
    data=excel_bytes,
    file_name=f"Rekap_KPI_{year_selected}.xlsx",
    mime="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
)