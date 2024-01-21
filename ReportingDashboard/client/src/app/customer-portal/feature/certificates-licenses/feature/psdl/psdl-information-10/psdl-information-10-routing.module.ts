import { NgModule } from '@angular/core';
import { PsdlInformation10Component } from './psdl-information-10.component';
import { Routes, RouterModule } from '@angular/router';

const routes: Routes = [
  {
    path: '',
    component: PsdlInformation10Component,
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class PsdlInformation10RoutingModule {}
