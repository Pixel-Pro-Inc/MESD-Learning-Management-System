import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { PsdlInformation5Component } from './psdl-information-5.component';
import { PsdlInformation5RoutingModule } from './psdl-information-5-routing.module';
import { ReactiveFormsModule } from '@angular/forms';
import { SharedUiModule } from 'src/app/shared/ui/shared-ui.module';
import { DropdownModule } from 'primeng/dropdown';
import { InputTextareaModule } from 'primeng/inputtextarea';
import { ChipsModule } from 'primeng/chips';
import { DataGridInputModule } from 'src/app/customer-portal/ui/data-grid-input/data-grid-input.module';

@NgModule({
  declarations: [PsdlInformation5Component],
  imports: [
    CommonModule,
    PsdlInformation5RoutingModule,
    ReactiveFormsModule,
    DropdownModule,
    ChipsModule,
    InputTextareaModule,
    DataGridInputModule,
    SharedUiModule,
  ],
})
export class PsdlInformation5Module {}
