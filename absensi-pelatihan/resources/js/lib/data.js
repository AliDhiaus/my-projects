import { faClipboardList, faFilePen, faFolder, faHouse, faPhoneVolume } from "@fortawesome/free-solid-svg-icons"

export const sideAdmin = [
    {
        id: 1,
        icon: faHouse,
        name: 'Dashboard',
        url: 'dashboard.admin'
    },
    {
        id: 2,
        icon: faClipboardList,
        name: 'Kelola Absensi',
        url: 'kelolaAbsensi'
    },
    {
        id: 3,
        icon: faFolder,
        name: 'Rekap Absen',
        url: 'rekapAbsensi'
    },
    {
        id: 4,
        icon: faFilePen,
        name: 'Manajemen Peserta',
        url: 'manajemenPeserta'
    },
]
export const sideUser = [
    {
        id: 1,
        icon: faHouse,
        name: 'Dashboard',
        url: 'dashboard.user'
    },
    {
        id: 2,
        icon: faClipboardList,
        name: 'Absensi',
        url: 'linkAbsensi'
    },
    {
        id: 3,
        icon: faFilePen,
        name: 'Laporan Absensi',
        url: 'laporanAbsensi'
    }
]
