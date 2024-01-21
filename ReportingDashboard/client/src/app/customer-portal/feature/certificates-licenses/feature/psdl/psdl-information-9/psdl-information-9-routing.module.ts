import { NgModule } from '@angular/core';
import { PsdlInformation9Component } from './psdl-information-9.component';
import { Routes, RouterModule } from '@angular/router';

const routes: Routes = [
  {
    path: '',
    component: PsdlInformation9Component,
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class PsdlInformation9RoutingModule {}
