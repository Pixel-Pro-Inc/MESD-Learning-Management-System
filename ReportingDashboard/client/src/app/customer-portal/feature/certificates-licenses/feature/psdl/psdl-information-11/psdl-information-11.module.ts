import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { PsdlInformation11Component } from './psdl-information-11.component';
import { PsdlInformation11RoutingModule } from './psdl-information-11-routing.module';
import { ReactiveFormsModule } from '@angular/forms';
import { SharedUiModule } from 'src/app/shared/ui/shared-ui.module';
import { DropdownModule } from 'primeng/dropdown';
import { InputTextareaModule } from 'primeng/inputtextarea';
import { ChipsModule } from 'primeng/chips';
import { DataGridInputModule } from 'src/app/customer-portal/ui/data-grid-input/data-grid-input.module';
import { FileUploadModule } from 'primeng/fileupload';

@NgModule({
  declarations: [PsdlInformation11Component],
  imports: [
    CommonModule,
    PsdlInformation11RoutingModule,
    ReactiveFormsModule,
    DropdownModule,
    ChipsModule,
    InputTextareaModule,
    DataGridInputModule,
    FileUploadModule,
    SharedUiModule,
  ],
})
export class PsdlInformation11Module {}
