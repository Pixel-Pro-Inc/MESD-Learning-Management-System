import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { AdminGuard } from './shared/guards/admin/admin.guard';
import { AuthGuard } from './shared/guards/auth/auth.guard';

const routes: Routes = [
  {
    path: '',
    loadChildren: () =>
      import('./home/feature/home.module').then((m) => m.HomeModule),
  },
  {
    path: 'sign-in',
    loadChildren: () =>
      import('./login/feature/login.module').then((m) => m.LoginModule),
  },
  {
    path: 'sign-up',
    loadChildren: () =>
      import('./signup/feature/sign-up/sign-up.module').then(
        (m) => m.SignUpModule
      ),
  },
  {
    path: 'admin-portal',
    canActivate: [AdminGuard],
    loadChildren: () =>
      import(
        './admin-portal/feature/admin-portal-shell/admin-portal-shell.module'
      ).then((m) => m.AdminPortalShellModule),
  },
  {
    path: 'portal',
    canActivate: [AuthGuard],
    loadChildren: () =>
      import(
        './customer-portal/feature/customer-portal-shell/customer-portal-shell.module'
      ).then((m) => m.CustomerPortalShellModule),
  },
  {
    path: 'verify',
    canActivate: [],
    loadChildren: () =>
      import('./verify/verify.module').then((m) => m.VerifyModule),
  },
  {
    path: 'password-reset',
    loadChildren: () =>
      import(
        './password-reset/feature/password-reset-shell/password-reset-shell.module'
      ).then((m) => m.PasswordResetShellModule),
  },
  { path: '**', redirectTo: '', pathMatch: 'full' },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule],
})
export class AppRoutingModule {}
