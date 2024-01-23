import { Component, OnInit } from '@angular/core';
import { AccountManagementGuard } from 'src/app/shared/guards/account-management/account-management.guard';
import { UserDto } from 'src/app/shared/models/user-dto';
import { AccountService } from 'src/app/shared/services/account-service/account.service';
import { PreferencesService } from 'src/app/shared/services/preferences-service/preferences.service';

@Component({
  selector: 'app-admin-portal',
  templateUrl: './admin-portal.component.html',
  styleUrls: ['./admin-portal.component.css'],
})
export class AdminPortalComponent implements OnInit {
  constructor(
    private accountService: AccountService,
    private preferencesService: PreferencesService
  ) {}

  ngOnInit(): void {}

  toggleSideBar() {
    var sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('open');

    var content = document.getElementById('content');
    content.classList.toggle('open');
  }

  showAccountOptions() {
    let user: UserDto = this.preferencesService.getPreferences().user;

    if (user) {
      return user.permissions.includes('Account Management');
    }

    return false;
  }

  logout() {
    this.accountService.logout();
  }
}
