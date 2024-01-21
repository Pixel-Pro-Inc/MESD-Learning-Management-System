export interface MenuItemDto {
  id: string;
  imgUrl: string;
  specialImgUrl: string;
  name: string;
  price: string;
  weight: string;
  description: string;
  category: string;
  subCategory: string;
  availability: boolean;
  activeSpecial: boolean;
  fufilled: boolean;
  options: any[];
  quantity: number;
  specialRequest: string;
}
