import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { PsdlInformation9Component } from './psdl-information-9.component';
import { PsdlInformation9RoutingModule } from './psdl-information-9-routing.module';
import { ReactiveFormsModule } from '@angular/forms';
import { SharedUiModule } from 'src/app/shared/ui/shared-ui.module';
import { DropdownModule } from 'primeng/dropdown';
import { InputTextareaModule } from 'primeng/inputtextarea';
import { ChipsModule } from 'primeng/chips';
import { DataGridInputModule } from 'src/app/customer-portal/ui/data-grid-input/data-grid-input.module';
import { FileUploadModule } from 'primeng/fileupload';

@NgModule({
  declarations: [PsdlInformation9Component],
  imports: [
    CommonModule,
    PsdlInformation9RoutingModule,
    ReactiveFormsModule,
    DropdownModule,
    ChipsModule,
    InputTextareaModule,
    DataGridInputModule,
    FileUploadModule,
    SharedUiModule,
  ],
})
export class PsdlInformation9Module {}
