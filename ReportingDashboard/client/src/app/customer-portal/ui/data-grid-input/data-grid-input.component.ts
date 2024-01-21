import { Component, Input, OnInit, ViewChild } from '@angular/core';
import {
  GridComponent,
  ColumnModel,
  EditSettingsModel,
  ToolbarItems,
} from '@syncfusion/ej2-angular-grids';
import { BusyService } from 'src/app/shared/services/busy-service/busy.service';

@Component({
  selector: 'app-data-grid-input',
  templateUrl: './data-grid-input.component.html',
  styleUrls: ['./data-grid-input.component.css'],
})
export class DataGridInputComponent implements OnInit {
  @Input() statisticalSummaryColumns: string[] = [];
  @Input() height: string = '250px';
  data: any[] = [];

  reportResult: any;
  public filterSettings: Object;

  @ViewChild('overviewgrid')
  public gridInstance: GridComponent;
  public editSettings?: EditSettingsModel;
  public toolbar?: ToolbarItems[];

  constructor(private busyService: BusyService) {}

  public ngOnInit(): void {
    this.filterSettings = { type: 'Menu' };
    this.editSettings = {
      allowEditing: true,
      allowAdding: true,
      allowDeleting: true,
      mode: 'Normal',
    };
    this.toolbar = ['Add', 'Edit', 'Delete', 'Update', 'Cancel'];
  }

  setTableValues(reportResultDto: any, type: string = '') {
    this.reportResult = reportResultDto;

    let _newColumn: ColumnModel[] = [];

    let count = 0;

    reportResultDto.columns.forEach((element) => {
      if (_newColumn.filter((i) => i.field == element.field).length == 0) {
        _newColumn.push({
          field: element.field,
          headerText: element.headerText,
          textAlign: element.textAlign,
          type: type,
          width: 215,
        });
      }

      count++;
    });

    this.data = reportResultDto.data;

    this.gridInstance.changeDataSource(reportResultDto.data, _newColumn);
  }

  public getDataSource() {
    return this.gridInstance.currentViewData;
  }

  async exportExcel() {
    this.busyService.busy();

    await this.delay(3000);
    // Export the grid to Excel
    this.gridInstance.excelExport();

    await this.delay(3000);

    this.busyService.idle();
  }

  delay(ms: number) {
    return new Promise((resolve) => setTimeout(resolve, ms));
  }

  formatAmount(amount: number) {
    return amount.toLocaleString('en-US', {
      minimumFractionDigits: 2,
    });
  }
}
