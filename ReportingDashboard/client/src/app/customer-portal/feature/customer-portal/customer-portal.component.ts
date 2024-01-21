import { Component, OnInit } from '@angular/core';
import { AccountService } from 'src/app/shared/services/account-service/account.service';

@Component({
  selector: 'app-customer-portal',
  templateUrl: './customer-portal.component.html',
  styleUrls: ['./customer-portal.component.css'],
})
export class CustomerPortalComponent implements OnInit {
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
