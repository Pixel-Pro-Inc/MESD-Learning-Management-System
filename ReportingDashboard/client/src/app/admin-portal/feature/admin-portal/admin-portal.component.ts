import { Component, OnInit } from '@angular/core';
import { UserDto } from 'src/app/shared/models/user-dto';
import { AccountService } from 'src/app/shared/services/account-service/account.service';

@Component({
  selector: 'app-admin-portal',
  templateUrl: './admin-portal.component.html',
  styleUrls: ['./admin-portal.component.css'],
})
export class AdminPortalComponent implements OnInit {
  constructor(private accountService: AccountService) {}

  ngOnInit(): void {}

  toggleSideBar() {
    var sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('open');

    var content = document.getElementById('content');
    content.classList.toggle('open');
  }

  logout() {
    this.accountService.logout();
  }
}
