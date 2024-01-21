import { NgModule } from '@angular/core';
import { PsdlInformation2Component } from './psdl-information-2.component';
import { Routes, RouterModule } from '@angular/router';

const routes: Routes = [
  {
    path: '',
    component: PsdlInformation2Component,
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class PsdlInformation2RoutingModule {}
