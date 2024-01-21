import { NgModule } from '@angular/core';
import { PsdlInformation5Component } from './psdl-information-5.component';
import { Routes, RouterModule } from '@angular/router';

const routes: Routes = [
  {
    path: '',
    component: PsdlInformation5Component,
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class PsdlInformation5RoutingModule {}
