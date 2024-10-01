# Bike Sharing Dashboard

### Setup Environment - Shell/Terminal
```
cd Submission
pip install openpyxl
pip install -r requirements.txt
```

## Menjalankan Aplikasi

```bash
streamlit run dashboard/bike_sharing_dashboard.py
```
## Struktur folder
```
Submission/
│
├── data/
│   ├── hour.xlsx
│   └── day.xlsx
│
└── dashboard/
    └── bike_sharing_dashboard.py
```

## Cara Menggunakan
1. Pilih tanggal menggunakan kalender di sidebar.
2. Setelah memilih tanggal, grafik jumlah penyewaan sepeda per jam untuk tanggal tersebut akan ditampilkan di bagian utama.
3. Anda juga dapat melihat statistik harian dari dataset.
