import { DataTable } from 'simple-datatables';
import { parse, add, format } from 'date-fns';

const dateAdder = (dateString, options) => {
    const parsedDate = parse(dateString, 'yyyy-MM-dd', new Date());
    const newDate = add(parsedDate, options);
    const newDateString = format(newDate, 'yyyy-MM-dd');

    return newDateString;
}

const DateFns = {
    add: dateAdder,
}

window.DataTable = DataTable;
window.DateFns   = DateFns;
