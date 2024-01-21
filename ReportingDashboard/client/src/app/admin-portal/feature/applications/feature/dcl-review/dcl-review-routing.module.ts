import { NgModule } from '@angular/core';
import { DclReviewComponent } from './dcl-review.component';
import { Routes, RouterModule } from '@angular/router';

const routes: Routes = [
  {
    path: '',
    component: DclReviewComponent,
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class DclReviewRoutingModule {}
