import { NgModule } from '@angular/core';
import { PsdlInformation11Component } from './psdl-information-11.component';
import { Routes, RouterModule } from '@angular/router';

const routes: Routes = [
  {
    path: '',
    component: PsdlInformation11Component,
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class PsdlInformation11RoutingModule {}
