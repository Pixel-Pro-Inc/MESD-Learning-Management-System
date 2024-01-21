import { NgModule } from '@angular/core';
import { PsdlInformation6Component } from './psdl-information-6.component';
import { Routes, RouterModule } from '@angular/router';

const routes: Routes = [
  {
    path: '',
    component: PsdlInformation6Component,
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class PsdlInformation6RoutingModule {}
