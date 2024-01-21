import {
  Component,
  Input,
  OnChanges,
  OnInit,
  SimpleChanges,
  ViewChild,
} from '@angular/core';
import { ClickEventArgs } from '@syncfusion/ej2-navigations';
import { ColumnModel, GridComponent } from '@syncfusion/ej2-angular-grids';
import { BusyService } from 'src/app/shared/services/busy-service/busy.service';

@Component({
  selector: 'app-data-grid',
  templateUrl: './data-grid.component.html',
  styleUrls: ['./data-grid.component.css'],
})
export class DataGridComponent implements OnInit, OnChanges {
  @ViewChild('overviewgrid')
  public gridInstance: GridComponent;

  @Input() data: any[] = [];
  @Input() columns: any[] = [];

  @Input() height: string = '250px';
  @Input() width: string = '750px';

  public filterSettings: Object = { type: 'Menu' };

  constructor(private busyService: BusyService) {}
  ngOnInit(): void {}

  ngOnChanges(changes: SimpleChanges) {
    if (changes.columns || changes.data) {
      if (this.columns.length != 0 && this.data.length != 0) {
        this.setTableValues({ columns: this.columns, data: this.data });
      }
    }
  }

  async setTableValues(reportResultDto: any, type: string = '') {
    let _newColumn: ColumnModel[] = [];

    reportResultDto.columns.forEach((element) => {
      if (_newColumn.filter((i) => i.field == element.field).length == 0) {
        _newColumn.push({
          field: element.field,
          headerText: element.headerText,
          textAlign: element.textAlign,
          type: type,
          width: 200,
        });
      }
    });

    this.data = reportResultDto.data;

    if (this.gridInstance == null) {
      await this.delay(100);
    }

    this.gridInstance.changeDataSource(reportResultDto.data, _newColumn);
  }

  delay(ms: number) {
    return new Promise((resolve) => setTimeout(resolve, ms));
  }

  formatAmount(amount: number) {
    return amount.toLocaleString('en-US', {
      minimumFractionDigits: 2,
    });
  }

  clickHandler(args: ClickEventArgs): void {
    this.gridInstance.clearFiltering();
  }
}
