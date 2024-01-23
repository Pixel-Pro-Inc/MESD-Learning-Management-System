import { NgModule } from '@angular/core';
import { AdminPortalComponent } from './admin-portal.component';
import { Routes, RouterModule } from '@angular/router';
import { AccountManagementGuard } from 'src/app/shared/guards/account-management/account-management.guard';

const routes: Routes = [
  {
    path: '',
    component: AdminPortalComponent,
    children: [
      {
        path: 'dashboard',
        canActivate: [],
        loadChildren: () =>
          import('../dashboard/dashboard.module').then(
            (m) => m.DashboardModule
          ),
      },
      {
        path: 'register-user',
        canActivate: [AccountManagementGuard],
        loadChildren: () =>
          import('../account-creation/account-creation.module').then(
            (m) => m.AccountCreationModule
          ),
      },
      {
        path: 'edit-user',
        canActivate: [AccountManagementGuard],
        loadChildren: () =>
          import('../edit-user/edit-user.module').then((m) => m.EditUserModule),
      },
      {
        path: 'school-analysis',
        //sahcanActivate: [AccountManagementGuard],
        loadChildren: () =>
          import('../school-analysis/school-analysis.module').then(
            (m) => m.SchoolAnalysisModule
          ),
      },
      { path: '**', redirectTo: 'dashboard', pathMatch: 'full' },
    ],
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class AdminPortalRoutingModule {}
