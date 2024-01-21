import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { DataGridComponent } from './data-grid.component';
import {
  FilterService,
  SortService,
  AggregateService,
  ExcelExportService,
  GridModule,
  GroupService,
  ResizeService,
  ToolbarService,
} from '@syncfusion/ej2-angular-grids';

@NgModule({
  declarations: [DataGridComponent],
  imports: [CommonModule, GridModule],
  exports: [DataGridComponent],
  providers: [
    FilterService,
    SortService,
    GroupService,
    AggregateService,
    ExcelExportService,
    ResizeService,
    ToolbarService,
  ],
})
export class DataGridModule {}
