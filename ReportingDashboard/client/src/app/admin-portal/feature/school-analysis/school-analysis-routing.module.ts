import { NgModule } from '@angular/core';
import { SchoolAnalysisComponent } from './school-analysis.component';
import { Routes, RouterModule } from '@angular/router';

const routes: Routes = [
  {
    path: '',
    component: SchoolAnalysisComponent,
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class SchoolAnalysisRoutingModule {}
