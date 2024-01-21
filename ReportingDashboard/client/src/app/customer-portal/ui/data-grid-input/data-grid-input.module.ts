import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { DataGridInputComponent } from './data-grid-input.component';
import {
  FilterService,
  SortService,
  AggregateService,
  ExcelExportService,
  GridModule,
  GroupService,
  ResizeService,
  ToolbarService,
  EditService,
} from '@syncfusion/ej2-angular-grids';

@NgModule({
  declarations: [DataGridInputComponent],
  imports: [CommonModule, GridModule],
  exports: [DataGridInputComponent],
  providers: [
    FilterService,
    SortService,
    GroupService,
    AggregateService,
    EditService,
    ExcelExportService,
    ResizeService,
    ToolbarService,
  ],
})
export class DataGridInputModule {}
