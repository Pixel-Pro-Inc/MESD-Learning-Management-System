import { NgModule } from '@angular/core';
import { ApplicationsComponent } from './applications.component';
import { Routes, RouterModule } from '@angular/router';

const routes: Routes = [
  {
    path: '',
    component: ApplicationsComponent,
    children: [
      {
        path: 'psdl',
        canActivate: [],
        loadChildren: () =>
          import('../psdl-review/psdl-review.module').then(
            (m) => m.PsdlReviewModule
          ),
      },
      {
        path: 'dcl',
        canActivate: [],
        loadChildren: () =>
          import('../dcl-review/dcl-review.module').then(
            (m) => m.DclReviewModule
          ),
      },
      {
        path: 'kpc',
        canActivate: [],
        loadChildren: () =>
          import('../kpc-review/kpc-review.module').then(
            (m) => m.KpcReviewModule
          ),
      },
      {
        path: 'rdep',
        canActivate: [],
        loadChildren: () =>
          import('../rdep-review/rdep-review.module').then(
            (m) => m.RdepReviewModule
          ),
      },
      {
        path: 'rough-diamond',
        canActivate: [],
        loadChildren: () =>
          import('../rough-diamond-review/rough-diamond-review.module').then(
            (m) => m.RoughDiamondReviewModule
          ),
      },
    ],
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class ApplicationsRoutingModule {}
