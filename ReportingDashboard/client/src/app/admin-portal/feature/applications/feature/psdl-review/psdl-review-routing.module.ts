import { NgModule } from '@angular/core';
import { PsdlReviewComponent } from './psdl-review.component';
import { Routes, RouterModule } from '@angular/router';

const routes: Routes = [
  {
    path: '',
    component: PsdlReviewComponent,
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class PsdlReviewRoutingModule {}
