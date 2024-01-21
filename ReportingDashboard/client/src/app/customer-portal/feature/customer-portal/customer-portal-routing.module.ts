import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { CustomerPortalComponent } from './customer-portal.component';

const routes: Routes = [
  {
    path: '',
    component: CustomerPortalComponent,
    children: [
      {
        path: 'welcome',
        canActivate: [],
        loadChildren: () =>
          import('../home/home.module').then((m) => m.HomeModule),
      },
      {
        path: 'my-applications',
        canActivate: [],
        loadChildren: () =>
          import('../my-applications/my-applications.module').then(
            (m) => m.MyApplicationsModule
          ),
      },
      {
        path: 'register-diamonds',
        canActivate: [],
        loadChildren: () =>
          import('../register-diamonds/register-diamonds.module').then(
            (m) => m.RegisterDiamondsModule
          ),
      },
      {
        path: 'certificates-licenses',
        canActivate: [],
        loadChildren: () =>
          import(
            '../certificates-licenses/feature/certificates-licenses/certificates-licenses.module'
          ).then((m) => m.CertificatesLicensesModule),
      },
      {
        path: 'permits',
        canActivate: [],
        loadChildren: () =>
          import('../permits/feature/permits/permits.module').then(
            (m) => m.PermitsModule
          ),
      },
      { path: '**', redirectTo: 'welcome', pathMatch: 'full' },
    ],
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class CustomerPortalRoutingModule {}
