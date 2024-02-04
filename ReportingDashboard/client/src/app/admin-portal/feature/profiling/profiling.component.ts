import { Component, OnInit } from '@angular/core';
import { ReportService } from '../../data-access/report.service';
import { ToastrService } from 'ngx-toastr';
import { BusyService } from 'src/app/shared/services/busy-service/busy.service';
import * as FileSaver from 'file-saver';
import jsPDF from 'jspdf';

@Component({
  selector: 'app-profiling',
  templateUrl: './profiling.component.html',
  styleUrls: ['./profiling.component.css'],
})
export class ProfilingComponent implements OnInit {
  constructor(
    private reportService: ReportService,
    private toastService: ToastrService,
    private busyService: BusyService
  ) {}
  users = [];

  cols: any[];

  exportColumns: any[];

  ngOnInit(): void {
    this.busyService.busy();
    this.reportService.getUsers().subscribe(
      (response) => {
        let x: any = response;
        this.users = x;
        this.busyService.idle();
      },
      (error) => {
        this.busyService.idle();
        this.toastService.error(
          'An error has occured please try again and report the issue if it persists.',
          'Error'
        );
      }
    );

    this.cols = [
      {
        field: 'nin',
        header: 'National Identity Number',
        customExportHeader: 'Product Code',
      },
      { field: 'userrole', header: 'User Role' },
      { field: 'firstname', header: 'First Name' },
      { field: 'lastname', header: 'Last Name' },
    ];

    this.exportColumns = this.cols.map((col) => ({
      title: col.header,
      dataKey: col.field,
    }));
  }

  convertUnixTimestampToString(unixTimestamp) {
    if (unixTimestamp == 0 || unixTimestamp == null) {
      return '';
    }
    // Multiply by 1000 to convert from seconds to milliseconds
    const date = new Date(unixTimestamp * 1000);

    // Format the date-time string
    let day = ('0' + date.getDate()).slice(-2);
    let month = ('0' + (date.getMonth() + 1)).slice(-2);
    let year = date.getFullYear();

    return `${day}/${month}/${year}`;
  }

  exportPdf() {
    // const doc = new jsPDF();
    const doc = new jsPDF('p', 'pt');
    doc['autoTable'](this.exportColumns, this.users);
    // doc.autoTable(this.exportColumns, this.products);
    doc.save('users.pdf');
  }

  exportExcel() {
    import('xlsx').then((xlsx) => {
      const worksheet = xlsx.utils.json_to_sheet(this.users);
      const workbook = { Sheets: { data: worksheet }, SheetNames: ['data'] };
      const excelBuffer: any = xlsx.write(workbook, {
        bookType: 'xlsx',
        type: 'array',
      });
      this.saveAsExcelFile(excelBuffer, 'products');
    });
  }
  saveAsExcelFile(buffer: any, fileName: string): void {
    let EXCEL_TYPE =
      'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=UTF-8';
    let EXCEL_EXTENSION = '.xlsx';
    const data: Blob = new Blob([buffer], {
      type: EXCEL_TYPE,
    });
    FileSaver.saveAs(
      data,
      fileName + '_export_' + new Date().getTime() + EXCEL_EXTENSION
    );
  }
}
