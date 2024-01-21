import { NgModule } from '@angular/core';
import { DocumentFormServiceComponent } from './document-form-service.component';
import { Routes, RouterModule } from '@angular/router';

const routes: Routes = [
  {
    path: '',
    component: DocumentFormServiceComponent,
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class DocumentFormServiceRoutingModule {}
