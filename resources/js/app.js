import './bootstrap';
import DataTable from 'datatables.net-dt';
console.log("a");

let table = new DataTable('#myTable', {
    responsive: true,
    language: {
        url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/pt-PT.json',
    },
});
