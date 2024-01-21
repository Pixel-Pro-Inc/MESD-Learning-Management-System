import { NgModule } from '@angular/core';
import { KpcReviewComponent } from './kpc-review.component';
import { Routes, RouterModule } from '@angular/router';

const routes: Routes = [
  {
    path: '',
    component: KpcReviewComponent,
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class KpcReviewRoutingModule {}
