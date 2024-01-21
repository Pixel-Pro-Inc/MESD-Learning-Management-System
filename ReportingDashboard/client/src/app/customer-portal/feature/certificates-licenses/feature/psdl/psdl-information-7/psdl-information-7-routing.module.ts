import { NgModule } from '@angular/core';
import { PsdlInformation7Component } from './psdl-information-7.component';
import { Routes, RouterModule } from '@angular/router';

const routes: Routes = [
  {
    path: '',
    component: PsdlInformation7Component,
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class PsdlInformation7RoutingModule {}
