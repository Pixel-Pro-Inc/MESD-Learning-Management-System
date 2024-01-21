import { NgModule } from '@angular/core';
import { PsdlInformation1Component } from './psdl-information-1.component';
import { Routes, RouterModule } from '@angular/router';

const routes: Routes = [
  {
    path: '',
    component: PsdlInformation1Component,
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class PsdlInformation1RoutingModule {}
