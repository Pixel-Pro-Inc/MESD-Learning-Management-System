import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { PsdlInformation10Component } from './psdl-information-10.component';
import { PsdlInformation10RoutingModule } from './psdl-information-10-routing.module';
import { ReactiveFormsModule } from '@angular/forms';
import { SharedUiModule } from 'src/app/shared/ui/shared-ui.module';
import { DropdownModule } from 'primeng/dropdown';
import { InputTextareaModule } from 'primeng/inputtextarea';
import { ChipsModule } from 'primeng/chips';
import { DataGridInputModule } from 'src/app/customer-portal/ui/data-grid-input/data-grid-input.module';
import { FileUploadModule } from 'primeng/fileupload';

@NgModule({
  declarations: [PsdlInformation10Component],
  imports: [
    CommonModule,
    PsdlInformation10RoutingModule,
    ReactiveFormsModule,
    DropdownModule,
    ChipsModule,
    InputTextareaModule,
    DataGridInputModule,
    FileUploadModule,
    SharedUiModule,
  ],
})
export class PsdlInformation10Module {}
