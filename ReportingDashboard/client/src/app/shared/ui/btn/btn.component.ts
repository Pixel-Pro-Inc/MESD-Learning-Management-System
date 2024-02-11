import { Component, Input, OnInit } from '@angular/core';

@Component({
  selector: 'app-btn',
  templateUrl: './btn.component.html',
  styleUrls: ['./btn.component.css'],
})
export class BtnComponent implements OnInit {
  @Input() label: string;
  @Input() icon: string;
  @Input() iconPos: string;
  @Input() loading: boolean;
  @Input() styleClass: string;
  @Input() disabled: string;

  constructor() {}

  ngOnInit(): void {}
}
