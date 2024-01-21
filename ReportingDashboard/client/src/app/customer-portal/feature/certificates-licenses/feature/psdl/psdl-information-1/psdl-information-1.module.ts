import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { PsdlInformation1Component } from './psdl-information-1.component';
import { PsdlInformation1RoutingModule } from './psdl-information-1-routing.module';
import { ReactiveFormsModule } from '@angular/forms';
import { SharedUiModule } from 'src/app/shared/ui/shared-ui.module';
import { DropdownModule } from 'primeng/dropdown';
import { InputTextareaModule } from 'primeng/inputtextarea';
import { ChipsModule } from 'primeng/chips';
import { DataGridInputModule } from 'src/app/customer-portal/ui/data-grid-input/data-grid-input.module';

@NgModule({
  declarations: [PsdlInformation1Component],
  imports: [
    CommonModule,
    PsdlInformation1RoutingModule,
    ReactiveFormsModule,
    DropdownModule,
    ChipsModule,
    InputTextareaModule,
    DataGridInputModule,
    SharedUiModule,
  ],
})
export class PsdlInformation1Module {}
