import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { TableModule } from 'primeng/table';
import { InputTextModule } from 'primeng/inputtext';
import { TooltipModule } from 'primeng/tooltip';
import { SchoolAnalysisComponent } from './school-analysis.component';
import { SchoolAnalysisRoutingModule } from './school-analysis-routing.module';
import { DropdownModule } from 'primeng/dropdown';
import { ReactiveFormsModule } from '@angular/forms';
import { ButtonModule } from 'primeng/button';

@NgModule({
  declarations: [SchoolAnalysisComponent],
  imports: [
    CommonModule,
    DropdownModule,
    ReactiveFormsModule,
    SchoolAnalysisRoutingModule,
    TableModule,
    ButtonModule,
    InputTextModule,
    TooltipModule,
  ],
})
export class SchoolAnalysisModule {}
