import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { TableModule } from 'primeng/table';
import { SchoolAnalysisComponent } from './school-analysis.component';
import { SchoolAnalysisRoutingModule } from './school-analysis-routing.module';

@NgModule({
  declarations: [SchoolAnalysisComponent],
  imports: [
    CommonModule, SchoolAnalysisRoutingModule,TableModule,    
  ]
})
export class SchoolAnalysisModule { }
