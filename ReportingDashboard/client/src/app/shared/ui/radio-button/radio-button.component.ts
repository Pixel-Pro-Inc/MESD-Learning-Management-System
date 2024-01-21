import { Component, Input, OnInit } from '@angular/core';

@Component({
  selector: 'app-radio-button',
  templateUrl: './radio-button.component.html',
  styleUrls: ['./radio-button.component.css'],
})
export class RadioButtonComponent implements OnInit {
  @Input() Value: any = null;
  @Input() Name: string = '';
  @Input() Default: boolean;
  constructor() {}

  ngOnInit(): void {}
}
