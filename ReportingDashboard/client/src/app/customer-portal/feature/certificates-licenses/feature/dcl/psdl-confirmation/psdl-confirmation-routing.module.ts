import { NgModule } from '@angular/core';
import { PsdlConfirmationComponent } from './psdl-confirmation.component';
import { Routes, RouterModule } from '@angular/router';

const routes: Routes = [
  {
    path: '',
    component: PsdlConfirmationComponent,
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class PsdlConfirmationRoutingModule {}
