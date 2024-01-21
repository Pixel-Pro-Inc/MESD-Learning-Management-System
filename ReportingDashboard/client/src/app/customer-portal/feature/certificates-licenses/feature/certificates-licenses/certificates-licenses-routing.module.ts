import { NgModule } from '@angular/core';
import { CertificatesLicensesComponent } from './certificates-licenses.component';
import { Routes, RouterModule } from '@angular/router';

const routes: Routes = [
  {
    path: '',
    component: CertificatesLicensesComponent,
    children: [
      {
        path: 'service',
        loadChildren: () =>
          import('../document-form-service/document-form-service.module').then(
            (m) => m.DocumentFormServiceModule
          ),
      },
      //PSDL
      {
        path: 'psdl-information-1',
        loadChildren: () =>
          import('../psdl/psdl-information-1/psdl-information-1.module').then(
            (m) => m.PsdlInformation1Module
          ),
      },
      {
        path: 'psdl-information-2',
        loadChildren: () =>
          import('../psdl/psdl-information-2/psdl-information-2.module').then(
            (m) => m.PsdlInformation2Module
          ),
      },
      {
        path: 'psdl-information-3',
        loadChildren: () =>
          import('../psdl/psdl-information-3/psdl-information-3.module').then(
            (m) => m.PsdlInformation3Module
          ),
      },
      {
        path: 'psdl-information-4',
        loadChildren: () =>
          import('../psdl/psdl-information-4/psdl-information-4.module').then(
            (m) => m.PsdlInformation4Module
          ),
      },
      {
        path: 'psdl-information-5',
        loadChildren: () =>
          import('../psdl/psdl-information-5/psdl-information-5.module').then(
            (m) => m.PsdlInformation5Module
          ),
      },
      {
        path: 'psdl-information-6',
        loadChildren: () =>
          import('../psdl/psdl-information-6/psdl-information-6.module').then(
            (m) => m.PsdlInformation6Module
          ),
      },
      {
        path: 'psdl-information-7',
        loadChildren: () =>
          import('../psdl/psdl-information-7/psdl-information-7.module').then(
            (m) => m.PsdlInformation7Module
          ),
      },
      {
        path: 'psdl-information-8',
        loadChildren: () =>
          import('../psdl/psdl-information-8/psdl-information-8.module').then(
            (m) => m.PsdlInformation8Module
          ),
      },
      {
        path: 'psdl-information-9',
        loadChildren: () =>
          import('../psdl/psdl-information-9/psdl-information-9.module').then(
            (m) => m.PsdlInformation9Module
          ),
      },
      {
        path: 'psdl-information-10',
        loadChildren: () =>
          import('../psdl/psdl-information-10/psdl-information-10.module').then(
            (m) => m.PsdlInformation10Module
          ),
      },
      {
        path: 'psdl-information-11',
        loadChildren: () =>
          import('../psdl/psdl-information-11/psdl-information-11.module').then(
            (m) => m.PsdlInformation11Module
          ),
      },
      {
        path: 'psdl-confirmation',
        loadChildren: () =>
          import('../psdl/psdl-confirmation/psdl-confirmation.module').then(
            (m) => m.PsdlConfirmationModule
          ),
      },
      //DCL
      {
        path: 'dcl-information-1',
        loadChildren: () =>
          import('../dcl/psdl-information-1/psdl-information-1.module').then(
            (m) => m.PsdlInformation1Module
          ),
      },
      {
        path: 'dcl-information-2',
        loadChildren: () =>
          import('../dcl/psdl-information-2/psdl-information-2.module').then(
            (m) => m.PsdlInformation2Module
          ),
      },
      {
        path: 'dcl-information-3',
        loadChildren: () =>
          import('../dcl/psdl-information-3/psdl-information-3.module').then(
            (m) => m.PsdlInformation3Module
          ),
      },
      {
        path: 'dcl-information-4',
        loadChildren: () =>
          import('../dcl/psdl-information-4/psdl-information-4.module').then(
            (m) => m.PsdlInformation4Module
          ),
      },
      {
        path: 'dcl-information-5',
        loadChildren: () =>
          import('../dcl/psdl-information-5/psdl-information-5.module').then(
            (m) => m.PsdlInformation5Module
          ),
      },
      {
        path: 'dcl-information-6',
        loadChildren: () =>
          import('../dcl/psdl-information-6/psdl-information-6.module').then(
            (m) => m.PsdlInformation6Module
          ),
      },
      {
        path: 'dcl-confirmation',
        loadChildren: () =>
          import('../dcl/psdl-confirmation/psdl-confirmation.module').then(
            (m) => m.PsdlConfirmationModule
          ),
      },
      //KPC
      {
        path: 'kpc-information-1',
        loadChildren: () =>
          import('../kpc/psdl-information-1/psdl-information-1.module').then(
            (m) => m.PsdlInformation1Module
          ),
      },
      {
        path: 'kpc-information-2',
        loadChildren: () =>
          import('../kpc/psdl-information-2/psdl-information-2.module').then(
            (m) => m.PsdlInformation2Module
          ),
      },
      {
        path: 'kpc-information-3',
        loadChildren: () =>
          import('../kpc/psdl-information-3/psdl-information-3.module').then(
            (m) => m.PsdlInformation3Module
          ),
      },
      {
        path: 'kpc-confirmation',
        loadChildren: () =>
          import('../kpc/psdl-confirmation/psdl-confirmation.module').then(
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
export class CertificatesLicensesRoutingModule {}
