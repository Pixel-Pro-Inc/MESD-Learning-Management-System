import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { PsdlInformation4Component } from './psdl-information-4.component';
import { PsdlInformation4RoutingModule } from './psdl-information-4-routing.module';
import { ReactiveFormsModule } from '@angular/forms';
import { SharedUiModule } from 'src/app/shared/ui/shared-ui.module';
import { DropdownModule } from 'primeng/dropdown';
import { InputTextareaModule } from 'primeng/inputtextarea';
import { ChipsModule } from 'primeng/chips';
import { DataGridInputModule } from 'src/app/customer-portal/ui/data-grid-input/data-grid-input.module';
import { FileUploadModule } from 'primeng/fileupload';

@NgModule({
  declarations: [PsdlInformation4Component],
  imports: [
    CommonModule,
    PsdlInformation4RoutingModule,
    ReactiveFormsModule,
    DropdownModule,
    ChipsModule,
    InputTextareaModule,
    DataGridInputModule,
    FileUploadModule,
    SharedUiModule,
  ],
})
export class PsdlInformation4Module {}
