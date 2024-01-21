import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { PermitsComponent } from './permits.component';

const routes: Routes = [
  {
    path: '',
    component: PermitsComponent,
    children: [
      {
        path: 'service',
        loadChildren: () =>
          import('../document-form-service/document-form-service.module').then(
            (m) => m.DocumentFormServiceModule
          ),
      },
      {
        path: 'rdep-information-1',
        loadChildren: () =>
          import('../rdep/psdl-information-1/psdl-information-1.module').then(
            (m) => m.PsdlInformation1Module
          ),
      },
      {
        path: 'rdep-information-2',
        loadChildren: () =>
          import('../rdep/psdl-information-2/psdl-information-2.module').then(
            (m) => m.PsdlInformation2Module
          ),
      },
      {
        path: 'rdep-information-3',
        loadChildren: () =>
          import('../rdep/psdl-information-3/psdl-information-3.module').then(
            (m) => m.PsdlInformation3Module
          ),
      },
      {
        path: 'rdep-information-4',
        loadChildren: () =>
          import('../rdep/psdl-information-4/psdl-information-4.module').then(
            (m) => m.PsdlInformation4Module
          ),
      },
      {
        path: 'rdep-confirmation',
        loadChildren: () =>
          import('../rdep/psdl-confirmation/psdl-confirmation.module').then(
            (m) => m.PsdlConfirmationModule
          ),
      },
      { path: '', redirectTo: 'service', pathMatch: 'full' },
    ],
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class PermitsRoutingModule {}
