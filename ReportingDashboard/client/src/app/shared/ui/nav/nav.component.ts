import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';
import { Router } from '@angular/router';
import { UserDto } from '../../models/user-dto';
import { AccountService } from '../../services/account-service/account.service';

@Component({
  selector: 'app-nav',
  templateUrl: './nav.component.html',
  styleUrls: ['./nav.component.css'],
})
export class NavComponent implements OnInit {
  @Input() ShowMenu: Boolean;
  @Output() toggle = new EventEmitter();
  user: any;

  constructor(
    private routerService: Router,
    private accountService: AccountService
  ) { }

  ngOnInit(): void {
    this.user = JSON.parse(localStorage.getItem('user'));
  }

  backwards() {
    window.history.back();
  }

  logout() {
    this.accountService.logout();
  }

  external() {
    if (this.user != null) {
      if (this.user.permissions.length == 1) {
        if (this.user.permissions[0] == 'External') {
          return true;
        }
      }
    }

    return false;
  }

  navBrand() {
    this.routerService.navigateByUrl('/');
  }

  toggleMenu() {
    this.toggle.emit();
  }
}
