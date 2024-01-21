import { NgModule } from '@angular/core';
import { RegisterDiamondsComponent } from './register-diamonds.component';
import { Routes, RouterModule } from '@angular/router';

const routes: Routes = [
  {
    path: '',
    component: RegisterDiamondsComponent,
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class RegisterDiamondsRoutingModule {}
