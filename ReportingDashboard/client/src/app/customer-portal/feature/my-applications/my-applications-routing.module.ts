import { NgModule } from '@angular/core';
import { MyApplicationsComponent } from './my-applications.component';
import { Routes, RouterModule } from '@angular/router';

const routes: Routes = [
  {
    path: '',
    component: MyApplicationsComponent,
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class MyApplicationsRoutingModule {}
