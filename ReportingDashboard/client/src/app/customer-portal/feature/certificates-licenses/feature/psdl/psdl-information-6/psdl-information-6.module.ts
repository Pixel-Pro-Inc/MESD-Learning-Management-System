import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { PsdlInformation6Component } from './psdl-information-6.component';
import { PsdlInformation6RoutingModule } from './psdl-information-6-routing.module';
import { ReactiveFormsModule } from '@angular/forms';
import { SharedUiModule } from 'src/app/shared/ui/shared-ui.module';
import { DropdownModule } from 'primeng/dropdown';
import { InputTextareaModule } from 'primeng/inputtextarea';
import { ChipsModule } from 'primeng/chips';
import { DataGridInputModule } from 'src/app/customer-portal/ui/data-grid-input/data-grid-input.module';

@NgModule({
  declarations: [PsdlInformation6Component],
  imports: [
    CommonModule,
    PsdlInformation6RoutingModule,
    ReactiveFormsModule,
    DropdownModule,
    ChipsModule,
    InputTextareaModule,
    DataGridInputModule,
    SharedUiModule,
  ],
})
export class PsdlInformation6Module {}
