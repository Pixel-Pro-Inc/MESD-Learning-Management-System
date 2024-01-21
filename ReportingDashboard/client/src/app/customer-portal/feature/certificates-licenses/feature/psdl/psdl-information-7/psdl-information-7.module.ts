import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { PsdlInformation7Component } from './psdl-information-7.component';
import { PsdlInformation7RoutingModule } from './psdl-information-7-routing.module';
import { ReactiveFormsModule } from '@angular/forms';
import { SharedUiModule } from 'src/app/shared/ui/shared-ui.module';
import { DropdownModule } from 'primeng/dropdown';
import { InputTextareaModule } from 'primeng/inputtextarea';
import { ChipsModule } from 'primeng/chips';
import { DataGridInputModule } from 'src/app/customer-portal/ui/data-grid-input/data-grid-input.module';

@NgModule({
  declarations: [PsdlInformation7Component],
  imports: [
    CommonModule,
    PsdlInformation7RoutingModule,
    ReactiveFormsModule,
    DropdownModule,
    ChipsModule,
    InputTextareaModule,
    DataGridInputModule,
    SharedUiModule,
  ],
})
export class PsdlInformation7Module {}
