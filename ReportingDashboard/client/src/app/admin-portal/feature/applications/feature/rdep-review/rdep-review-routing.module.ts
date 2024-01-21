import { NgModule } from '@angular/core';
import { RdepReviewComponent } from './rdep-review.component';
import { Routes, RouterModule } from '@angular/router';

const routes: Routes = [
  {
    path: '',
    component: RdepReviewComponent,
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class RdepReviewRoutingModule {}
