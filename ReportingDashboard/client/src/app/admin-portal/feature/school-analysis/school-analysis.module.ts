import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { TableModule } from 'primeng/table';
import { InputTextModule } from 'primeng/inputtext';
import { FormsModule } from '@angular/forms'; 
import { SchoolAnalysisComponent } from './school-analysis.component';
import { SchoolAnalysisRoutingModule } from './school-analysis-routing.module';

@NgModule({
  declarations: [SchoolAnalysisComponent],
  imports: [
    CommonModule, SchoolAnalysisRoutingModule,TableModule, InputTextModule, FormsModule,
     
  ]
})
export class SchoolAnalysisModule { }
