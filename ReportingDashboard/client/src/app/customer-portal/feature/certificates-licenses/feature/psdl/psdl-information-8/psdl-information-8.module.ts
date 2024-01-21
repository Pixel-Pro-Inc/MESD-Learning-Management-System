import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { PsdlInformation8Component } from './psdl-information-8.component';
import { PsdlInformation8RoutingModule } from './psdl-information-8-routing.module';
import { ReactiveFormsModule } from '@angular/forms';
import { SharedUiModule } from 'src/app/shared/ui/shared-ui.module';
import { DropdownModule } from 'primeng/dropdown';
import { InputTextareaModule } from 'primeng/inputtextarea';
import { ChipsModule } from 'primeng/chips';
import { DataGridInputModule } from 'src/app/customer-portal/ui/data-grid-input/data-grid-input.module';

@NgModule({
  declarations: [PsdlInformation8Component],
  imports: [
    CommonModule,
    PsdlInformation8RoutingModule,
    ReactiveFormsModule,
    DropdownModule,
    ChipsModule,
    InputTextareaModule,
    DataGridInputModule,
    SharedUiModule,
  ],
})
export class PsdlInformation8Module {}
