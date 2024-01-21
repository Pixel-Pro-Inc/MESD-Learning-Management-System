import { NgModule } from '@angular/core';
import { PsdlInformation8Component } from './psdl-information-8.component';
import { Routes, RouterModule } from '@angular/router';

const routes: Routes = [
  {
    path: '',
    component: PsdlInformation8Component,
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class PsdlInformation8RoutingModule {}
