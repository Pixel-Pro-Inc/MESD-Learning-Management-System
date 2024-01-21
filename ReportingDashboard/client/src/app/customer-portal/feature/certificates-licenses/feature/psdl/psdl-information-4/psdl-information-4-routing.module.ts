import { NgModule } from '@angular/core';
import { PsdlInformation4Component } from './psdl-information-4.component';
import { Routes, RouterModule } from '@angular/router';

const routes: Routes = [
  {
    path: '',
    component: PsdlInformation4Component,
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class PsdlInformation4RoutingModule {}
