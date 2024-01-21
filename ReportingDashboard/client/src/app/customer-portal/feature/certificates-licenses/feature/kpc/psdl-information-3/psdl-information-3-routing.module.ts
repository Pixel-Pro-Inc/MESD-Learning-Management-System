import { NgModule } from '@angular/core';
import { PsdlInformation3Component } from './psdl-information-3.component';
import { Routes, RouterModule } from '@angular/router';

const routes: Routes = [
  {
    path: '',
    component: PsdlInformation3Component,
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class PsdlInformation3RoutingModule {}
