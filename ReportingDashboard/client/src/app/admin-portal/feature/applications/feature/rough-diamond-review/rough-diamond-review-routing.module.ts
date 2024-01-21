import { NgModule } from '@angular/core';
import { RoughDiamondReviewComponent } from './rough-diamond-review.component';
import { Routes, RouterModule } from '@angular/router';

const routes: Routes = [
  {
    path: '',
    component: RoughDiamondReviewComponent,
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class RoughDiamondReviewRoutingModule {}
